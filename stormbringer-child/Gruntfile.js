module.exports = function(grunt) {

  // 1. All configuration goes here
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

    // Modernizr
    modernizr: {
      dist: {
        crawl: false,
        devFile: false,
        uglify: false,
        dest: 'js/src/modernizr.js',
        options: [
          'setClasses',
          'addTest',
          'testProp',
          'fnBind'
        ],
        tests : [
          'cookies',
          'svg',
          'touchevents',
          'pointerevents',
          'cssanimations',
          'backgroundblendmode',
          'backgroundcliptext',
          'bgpositionshorthand',
          'bgpositionxy',
          'backgroundsize',
          'bgsizecover',
          'borderradius',
          'boxshadow',
          'flexbox',
          'mediaqueries',
          'csstransforms',
          'cssvhunit',
          'cssvwunit'
        ]
      }
    },

    // Combine our javascript files into one
    concat: {
      dist: {
        src: [
          'js/src/modernizr.js',
          '../stormbringer/js/src/common.js',
          'js/src/application.js',
        ],
        dest: 'js/scripts.js',
      }
    },

    // Minify javascript
    uglify: {
      build: {
        src: 'js/scripts.js',
        dest: 'js/scripts.min.js'
      }
    },

    sass: {
      options: {
        loadPath: ['../stormbringer/scss']
      },
      dist: {
        options: {
          style: 'expanded',
          loadPath: ['../stormbringer/scss'],
        },
        files: {
          'css/styles.css': ['scss/application.scss'],
        }
      },

    },


    cssmin: {
      combine: {
        files: {
          'css/styles.min.css': ['css/styles.css']
        }
      }
    },

    watch: {
      options: {
        livereload : 35729,
      },

      scripts: {
        files: ['js/src/*.js'],
        tasks: ['concat', 'uglify', 'clean', 'assets_versioning'],
        options: {
          spawn: false,
        },
      },

      css: {
        files: ['scss/*.scss', '../stormbringer/scss/bootstrap/*.scss', '../stormbringer/scss/helpers/*.scss'],
        tasks: ['sass', 'cssmin', 'clean', 'assets_versioning'],
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
  grunt.loadNpmTasks('grunt-modernizr');

  // Tasks registration
  grunt.registerTask('default', ['modernizr', 'concat', 'uglify', 'sass', 'cssmin', 'watch']);

};
