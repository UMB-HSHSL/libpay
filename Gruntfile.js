module.exports = function(grunt) {

  grunt.initConfig({

    // Watches for changes and runs tasks
    // Livereload is setup for the 35729 port by default
    watch: {
      php: {
        files: ['**/*.php'],
        options: {
                // Start a live reload server on the default port 35729
                livereload: {
//                    key: grunt.file.read('/Users/zburke/projects/hshsl/config/server.key'),
//                    cert: grunt.file.read('/Users/zburke/projects/hshsl/config/server.crt'),
                    key: grunt.file.read('config/livereload.key'),
                    cert: grunt.file.read('config/livereload.crt'),
                    options: { livereload: true },
                },
        }
      }
    },

  });

  // Default task
  grunt.registerTask('default', ['watch']);

  // Load up tasks
  grunt.loadNpmTasks('grunt-contrib-watch');

};
