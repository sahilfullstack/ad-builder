<template>
    <div class="modal fade" role="dialog" tabindex="-1">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
                    <h5 class="modal-title">Add A New Subscription</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span></button>
				</div>
				<div class="modal-body">
					<form>
                        <div class="form-group">
                            <label>Layout</label>
                            <select name="layout_id" id="layout_id" class="form-control" v-model="layout_id">    
                                <option v-for="layout in layouts" :key="layout.id" :value="layout.id">{{ layout.name }}</option>
                            </select>
                            <span class="text-danger" :class="{'hidden': errors['layout_id'] == undefined}" style="margin-right:10px;">{{errors['layout_id']}}</span>
                        </div>
                        <div class="form-group">
                            <label for="date" class="control-label h5">Allowed Quantity</label>
                            <input type="number" v-model="allowedQuantity" >
                        </div>
                        <div class="form-group">
                            <label for="date" class="control-label h5">Allow Videos</label>
                            <input type="checkbox" v-model="allowVideos" >
                        </div>
                        <div class="form-group">
                            <label for="date" class="control-label h5">Expiry Date</label>
                            <date-picker v-model="expiring_at" lang="en"></date-picker>
                        </div>
					</form>
				</div>
				<div class="modal-footer">
					<span class="text-danger" :class="{'hidden': errors['general'] == undefined}" style="margin-right:10px;">{{errors['general']}}</span>

					<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					<button type="button" class="btn btn-primary" v-on:click="add" :disabled="disable.adding">Add</button>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
    props: {
        userId: {
            type: Number,
            required: true
        },
        layouts: {
            type: Array,
            required: true
        }
    },

    data() {
        return {
            expiring_at: moment().add(30, 'days')._d,
            allowedQuantity: 1,
            layout_id: this.layouts[0].id,
            allowVideos : 0,
            errors: [],
            disable: {
                adding: false
            } 
        }
    },

    methods: {
        add() {
            this.disable.adding = true;
                   let thiz = this; 
            axios.post('/api/users/' + this.userId + '/subscriptions',  {layout_id: this.layout_id, expiring_at: this.expiring_at.toISOString().substring(0, 10), allowed_quantity: this.allowedQuantity, allow_videos: this.allowVideos})
            .then(function (response) {
                thiz.disable.adding = false;

                thiz.$emit('resolve');          
            })
            .catch(function (error) {
                thiz.disable.adding = false;
                console.log(error);
                _.forEach(error.response.data.errors, function(error, index) {
                    var errorIndex = _.startsWith(index, '_')
                                        ? _.trim(index, '_')
                                        : index;
                                        
                    thiz.errors[errorIndex] = error[0];
                });
            });                    
        }
    }
}
</script>

