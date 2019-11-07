module.exports = function(grunt) {
	var target = grunt.option('justCompile');
	var public_dir = '../../public';
	
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		
		concat: {
			dist: {
				src: [
					'./js/**/*.js',
				],
				dest: '../../public/js/script.js'
			}
		},

		less: {
			development: {
				options: {
					compress: true,
					yuicompress: true,
					optimization: 2
				},
				files: {
					"../../public/css/style.css": "css/*.css"
				}
			}
		},
		
		watch: {
			scripts: {
				files: ['js/**/*.js'],
				tasks: ['concat'],
				options: {
					spawn: false
				}
			},
			styles: {
				files: ['css/**/*.css'],
				tasks: ['less'],
				options: {
					spawn: false,
				}
			}
		}
	});

	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-less');
	
	if (target == 1) {
		grunt.registerTask('default', ['concat', 'less']);
	}
	else {
		grunt.registerTask('default', ['concat', 'less', 'watch']);
	}
};