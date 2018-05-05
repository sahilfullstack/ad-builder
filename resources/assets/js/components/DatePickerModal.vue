<template>
	<div class="modal fade" role="dialog" tabindex="-1">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span></button>
				</div>
				<div class="modal-body">
					<div class="col-xs-12 text-left">{{displayMessage}}</div>
					<form>
						<div class="row">
							<div class="col-md-12 form-group">
								<label for="date" class="control-label h5">Expiry Date</label>
								 <input type="date" v-model="date" >
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 form-group">
								<label for="date" class="control-label h5">Allowed Quantity</label>
								 <input type="number" v-model="allowedQuantity" >
							</div>
						</div>
					</form>
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
    		},
    		defaultDate: {
    			type: String,
    			required: true,
    		},
    		defaultQuantity: {
    			type: Number,
    			required: true,
    		},
    	},

    	data: function() {

    		return {
    			date: moment(this.defaultDate).format('YYYY-MM-DD'),
    			allowedQuantity: this.defaultQuantity,
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

				var finalQuantity = self.allowedQuantity;
				var allowedQuantity = Number(self.allowedQuantity);

				this.errors = [];
				if(self.date == "")
				{
					self.errors["general"] = "Expiry Date should not be empty";            				
				}
				else if(typeof allowedQuantity != 'number'){
					self.errors["general"] = "allowed quantity should be a valid number.";            				
				}
				else if(allowedQuantity == ''){
					self.errors["general"] = "Allowed Quantity should not be empty.";            				
				}
				else
				{
					var finalDate = self.date;
					var finalQuantity = allowedQuantity;
					self.$emit('resolve', {date : finalDate, quantity: finalQuantity});
				}
			}
    	}
    }
</script>
