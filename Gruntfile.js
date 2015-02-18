module.exports = function(grunt) {

  grunt.initConfig({

    // Watches for changes and runs tasks
    // Livereload is setup for the 35729 port by default
    watch: {
      php: {
        files: ['**/*.php', '**/*.css', '**/*.js'],
        options: {
                // Start a live reload server on the default port 35729
                livereload: {
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
