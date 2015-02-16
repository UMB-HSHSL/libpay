#!/bin/sh

#
# generic git deployment script
#
# assumes a copy of the repository to deploy is checked out at $SRC/$REPO.
# specify destination directory with $DST.
#
# usage: $0 <repo-name> <tag-name>
#
# Assumes releases are tagged on the master branch. This script performs an
# archive action to create a directory named for a given repository and tag
# and creates a symlink to a tagged release in the $DST directory.
#
# New tags must be explicitly pushed to the origin as follows:
#
# 	git tag -a 0-0-0 -m "tag comment"
# 	git push origin --tags
#
# and are pulled by "git fetch --tags".
#
# Zak Burke, zburke@hshsl.umaryland.edu
# 2015-02-16
#


# repository should be checked out to this directory
SRC=/home/zburke/projects/releases

# document root; symlink in this directory will point to repository
# exported into $SRC, above
DST=/cygdrive/w/HSHSL/bin/test/zburke


# --
# -- NOTHING TO CONFIGURE BELOW
# --

if [[ ! -d $SRC ]]; then
    echo "The source directory '$SRC' does not exist."
    exit 1;
fi


if [[ ! -d $DST ]]; then
    echo "The deployment directory '$DST' does not exist."
    exit 1;
fi

if [[ -z $1 ]]; then
    echo "usage: $0 <repo-name> <release-tag>"
    exit 1;
fi
REPO=$1

if [[ -z $2 ]]; then
    echo "usage: $0 <repo-name> <release-tag>"
    echo "recent tags:"
    cd $SRC/$REPO
    git tag -n1 | tail -5
    exit 1;
fi

TAG=$2

if [[ ! -d $SRC/$REPO ]]; then
    echo "The source directory '$SRC' does not contain the repository '$REPO'."
    exit 1;
fi


echo "syncing the repository..."
cd $SRC/$REPO
git fetch --tags -q

if ! git tag | grep -q $TAG; then
    echo "The tag '$TAG' could not be found in the repository."
    echo "usage: $0 <repo-name> <release-tag>\nrecent tags:"
    git tag -n1 | tail -5
    exit 1;
fi


if [[ ! -d $SRC/$REPO-$TAG ]]; then
    echo "exporting release $TAG..."
    mkdir $SRC/$REPO-$TAG
    git archive $TAG | tar -x -C $SRC/$REPO-$TAG
else
    echo "release $TAG already in place; deploying existing copy"
fi

cd $SRC
echo "installing release $TAG..."
tar czf $REPO-$TAG.tgz $REPO-$TAG
cp $SRC/$REPO-$TAG.tgz $DST/
cd $DST
tar xzf $REPO-$TAG.tgz
mv $REPO _$REPO
cp -R $REPO-$TAG $REPO

echo "DONE!"

