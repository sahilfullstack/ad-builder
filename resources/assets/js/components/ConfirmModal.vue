<template>
	<div class="modal fade" role="dialog" tabindex="-1">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span></button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-xs-12 text-left">{{displayMessage}}</div>
					</div>
				</div>
				<div class="modal-footer">
					<span class="text-danger" :class="{'hidden': errors['general'] == undefined}" style="margin-right:10px;">{{errors['general']}}</span>

					<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
					<button type="button" class="btn btn-primary" v-on:click="onClick" :disabled="disable.yes">Yes</button>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
    export default {

    	props: {
    		message: {
    			type: String,
    			required: true,
    		}
    	},

    	data: function() {
    		return {	
    			displayMessage: this.message,
				errors: [],
	    		disable: {
	    			yes: false
	    		} 
			}
    	},
    	watch : {
            permission : function (permission) {
                this.errors = [];
                this.disable.yes = false;
            }
        },
    	methods: {
    		onClick: function(event) {
    			event.preventDefault();
				var self = this;

				this.errors = [];
            
            	self.$emit('resolve');
			}
    	}
    }
</script>
