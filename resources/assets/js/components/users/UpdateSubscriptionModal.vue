<template>
    <div class="modal fade" role="dialog" tabindex="-1">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
                    <h5 class="modal-title">Update A Subscription</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span></button>
				</div>
				<div class="modal-body">
					<form>
                        <div class="form-group">
                            <label>Layout: <strong>{{ this.layout.name }}</strong></label>
                        </div>
                        <div class="form-group">
                            <label for="date" class="control-label h5">Expiry Date</label>
                            <date-picker v-model="expiring_at" lang="en"></date-picker>
                        </div>
                        <div class="form-group">
                            <label for="date" class="control-label h5">Days</label>
                            <input class="form-control" type="number" v-model="days" >
                        </div>
                        <div class="form-group">
                            <input class="form-check-input" type="checkbox" v-model="allowVideos" >
                            <label for="date" class="control-label h5">Allow Videos</label>
                        </div>
                        <div class="form-group">
                            <input class="form-check-input" type="checkbox" v-model="allowHover" >
                            <label for="date" class="control-label h5">Allow Hover</label>
                        </div>
                        <div class="form-group">
                            <input class="form-check-input" type="checkbox" v-model="allowPopout" >
                            <label for="date" class="control-label h5">Allow Popout</label>
                        </div>
					</form>
				</div>
				<div class="modal-footer">
					<span class="text-danger" :class="{'hidden': errors['general'] == undefined}" style="margin-right:10px;">{{errors['general']}}</span>

					<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					<button type="button" class="btn btn-primary" v-on:click="update" :disabled="disable.updating">Update</button>
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
        layout: {
            type: Object,
            required: true
        },
        currentExpiringAt: {
            type: String,
            required: true,
        },
        currentDays: {
            type: Number,
            required: true,
        },
        currentAllowVideos: {
            type: Boolean,
            required: true,
        },
        currentAllowHover: {
            type: Boolean,
            required: true,
        },
        currentAllowPopout: {
            type: Boolean,
            required: true,
        }
    },

    data() {
        return {
            expiring_at: moment(this.currentExpiringAt)._d,
            days: this.currentDays,
            layout_id: this.layout.id,
            allowVideos : this.currentAllowVideos == null ? false : true,
            allowHover : this.currentAllowHover == null ? false : true,
            allowPopout : this.currentAllowPopout == null ? false : true,
            errors: [],
            disable: {
                updating: false
            } 
        }
    },

    methods: {
        update() {
            this.disable.updating = true;
                   let thiz = this; 
            axios.put('/api/users/' + this.userId + '/subscriptions',  {
                layout_id: this.layout_id,
                expiring_at: this.expiring_at.toISOString().substring(0, 10),
                days: this.days,
                allow_videos: this.allowVideos,
                allow_hover: this.allowHover,
                allow_popout: this.allowPopout
            })
            .then(function (response) {
                thiz.disable.updating = false;

                thiz.$emit('resolve');          
            })
            .catch(function (error) {
                thiz.disable.updating = false;
                
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

