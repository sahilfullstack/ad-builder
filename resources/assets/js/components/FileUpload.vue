<template>
	<div class="modal fade" :id="modalIdentifier" role="dialog" tabindex="-1">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span></button>
					<h4 class="modal-title">File Uploader</h4>
				</div>
				<div class="modal-body">
					<form>
						<div class="row">
							<div class="col-xs-12">
								<div class="form-group">
									<label for="file" class="control-label h5">File</label>
									<input type="file" @change="onFileChange">

									<span class="text-danger" :class="{'hidden': errors['file'] == undefined}" style="margin-right:10px;">{{errors['file']}}</span>
								</div>
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">

					<span class="text-danger" :class="{'hidden': errors['general'] == undefined}" style="margin-right:10px;">{{errors['general']}}</span>
					<button type="button" class="btn btn-primary" v-on:click="upload" :disabled="disable.upload">Upload</button>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
    export default {

    	props: ['modalIdentifier', 'apiPath', 'prefilled'],

    	data: function() {
    		return {
    			form: {
    				file: null
    			},
    			isLoading: false,
                errors: [],
                disable: {
                    upload: false
                }
    		}
    	},

		methods: {
			getPreparedData: function() {
				const data = new FormData();

				data.append('file', this.form.file);

				return data;
			},			
			upload: function(event) {

				event.preventDefault();
                var self = this;
                
                this.errors = [];
                this.disable.upload = true;

				axios.post(this.apiPath, this.getPreparedData())
                    .then(function (response) {

						self.disable.upload = false;
                        self.$emit('resolve', response.data.data.url);
                    })
                    .catch(function (error) {

                        self.disable.upload = false;

                        _.forEach(error.response.data.errors, function(error, index) {
                            var errorIndex = _.startsWith(index, '_')
                                                ? _.trim(index, '_')
                                                : index;
                                                
                            self.errors[errorIndex] = error[0];
                        });
                    });
			},
			onFileChange: function(event) {
				var files = event.target.files || event.dataTransfer.files;
				
                if (!files.length) return;
                
				this.form.file = files[0];
			}
		}
    }
</script>
