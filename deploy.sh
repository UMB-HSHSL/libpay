#!/bin/sh

#
# generic git deployment script
#
# usage: $0 <tag-name> [deployment-dir]
#
# deployment-dir is hardcoded but may be overridden in at runtime.
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
# Zak Burke, zburke@hshsl.umaryland.edu
# 2015-02-16
#


# default deployment directory; may be overridden by passing in a
# path on the commandline after the release tag.
#
# application will be deployed into this directory with a symlink
# pointing from the repository name to a versioned directory, i.e.
#
#     cd <deployment-directory>
#     ln -s <repository-name>-<tag> <repository-name>
#
DST=/cygdrive/w/HSHSL/bin/test/zburke


# --
# -- NOTHING TO CONFIGURE BELOW
# --

DIST=$PWD/dist

# extract the name of the repository
REPO=`git config remote.origin.url| sed -e 's/.*\/\(.*\)\.git/\1/'`



if [[ -z $1 ]]; then
    echo "usage: $0 <release-tag> [destination]"
    echo "recent tags:"
    git for-each-ref --sort=taggerdate --format '%(refname) %(*subject)' refs/tags | tail -5
    exit 1;
fi

TAG=$1

if [[ $2 ]]; then
  DST=$2
fi
if [[ ! -d $DST ]]; then
    echo "The deployment directory '$DST' does not exist."
    exit 1;
fi


echo "syncing the repository..."
git fetch --tags -q

if ! git tag | grep -q $TAG; then
    echo "The tag '$TAG' could not be found in the repository."
    echo "usage: $0 <release-tag> [destination]\nrecent tags:"
    git tag -n1 | tail -5
    exit 1;
fi


if [[ ! -d $SRC/$REPO-$TAG ]]; then
    echo "exporting release $TAG..."
    mkdir -p $DIST/$REPO-$TAG
    git archive $TAG | tar -x -C $DIST/$REPO-$TAG
else
    echo "release $TAG already in place; deploying existing copy"
fi
cd $DIST
tar czf $REPO-$TAG.tgz $REPO-$TAG

echo "installing release $TAG at $DST..."
cp $DIST/$REPO-$TAG.tgz $DST/
cd $DST
tar xzf $REPO-$TAG.tgz

# deny web access to application and config directories
cp $REPO-$TAG/htdocs/web.config ./

# stupid stupid STUPID IIS7 will not traverse a shortcut and
# Windows requires Administrative access to use mklink, so instead
# The Scriptmeister deploys by makin' copies.
#
# prepare copies (slow) then move them into place (fast).
cp -R $REPO-$TAG $REPO.NEW
if [[ -d $REPO ]]; then
	mv $REPO $REPO.OLD
fi
mv $REPO.NEW $REPO

if [[ -d $REPO.OLD ]]; then
	rm -rf $REPO.OLD;
fi

cp -R $REPO/htdocs/assets assets.NEW
if [[ -d assets ]]; then
  mv assets assets.OLD
fi
mv assets.NEW assets

if [[ -d assets.OLD ]]; then
  rm -rf assets.OLD;
fi

if [[ ! -d config ]]; then
  cp -R $REPO/config ./
fi

if [[ ! -f index.php ]]; then
  cp -R $REPO/htdocs/index.php ./
fi


echo "DONE!"
