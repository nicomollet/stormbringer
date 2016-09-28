module.exports = function(grunt) {

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

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
          'cssvwunit',
          'objectfit'
        ]
      }
    },

    // Clean old files
    clean: {
      js: ['js/scripts.min.*.js', '!js/scripts.min.' + grunt.template.today('yyyymm') + '*.js'],
      css: ['css/styles.min.*.css', '!css/styles.min.' + grunt.template.today('yyyymm') + '*.css']
    },

    // Versioning
    assets_versioning: {
      deployment: {
        options: {
          dateFormat: 'YYYYMMDDHH',
          tag: 'date',
          versionsMapFile: 'inc/front/gruntassets.php',
          versionsMapTemplate: 'inc/front/gruntassets.tpl',
        },
        files: {
          'css/styles.min.css': ['css/styles.min.css'],
          'js/scripts.min.js': ['js/scripts.min.js'],
        }
      }
    },

    // Combine javascript
    concat: {
      dist: {
        src: [
          'js/src/modernizr.js',
          'js/src/common.js',
          'js/src/application.js',
        ],
        dest: 'js/scripts.js',
      }
    },

    // Sass compilation
    sass: {
      dist: {
        options: {
          style: 'expanded'
        },
        files: {
          'css/styles.css': 'scss/application.scss'
        }
      }
    },


    // Minify javascript
    uglify: {
      build: {
        src: 'js/scripts.js',
        dest: 'js/scripts.min.js'
      }
    },


    // Minify CSS
    cssmin: {
      combine: {
        files: {
          'css/styles.min.css': ['css/styles.css']
        }
      }
    },

    // Watch
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
        files: ['scss/*.scss', 'scss/bootstrap/*.scss', 'scss/helpers/*.scss'],
        tasks: ['sass', 'cssmin', 'clean', 'assets_versioning'],
        options: {
          spawn: false,
        }
      },
    }
  });

  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-sass');
  grunt.loadNpmTasks('grunt-contrib-cssmin');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-assets-versioning');
  grunt.loadNpmTasks('grunt-contrib-clean');
  grunt.loadNpmTasks('grunt-modernizr');


  // Tasks registration
  grunt.registerTask('default', ['modernizr', 'concat', 'uglify', 'sass', 'cssmin', 'watch', 'assets_versioning', 'clean']);

};
