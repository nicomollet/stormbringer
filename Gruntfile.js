module.exports = function(grunt) {

  // 1. All configuration goes here
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

    // Combine our javascript files into one
    concat: {
      dist: {
        src: [
          'js/common.js',   // Common
          'js/bootstrap-modalgallery.js',   // Bootstrap Modal Gallery
          'js/bootstrap-modalopen.js',   // Bootstrap Modal
          'js/app.js',   // Custom JS
        ],
        dest: 'js/production.js',
      }
    },

    // Minify javascript
    uglify: {
      build: {
        src: 'js/production.js',
        dest: 'js/production.min.js'
      }
    },

    sass: {
      dist: {
        options: {
          style: 'expanded'
        },
        files: {
          'css/application.css': 'scss/application.scss'
        }
      }
    },


    cssmin: {
      combine: {
        files: {
          'css/application.min.css': ['css/application.css']
        }
      }
    },

    watch: {
      options: {
        livereload : 8080,
      },

      scripts: {
        files: ['js/*.js'],
        tasks: ['concat', 'uglify'],
        options: {
          spawn: false,
        },
      },

      css: {
        files: ['scss/*.scss', 'scss/bootstrap/*.scss'],
        tasks: ['sass', 'cssmin'],
        options: {
          spawn: false,
        }
      },

    }

  });

  // 3. Where we tell Grunt we plan to use this plug-in.
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-sass');
  grunt.loadNpmTasks('grunt-contrib-cssmin');
  grunt.loadNpmTasks('grunt-contrib-watch');


  // 4. Where we tell Grunt what to do when we type "grunt" into the terminal.
  grunt.registerTask('default', ['concat', 'uglify', 'sass', 'cssmin', 'watch']);

};
