<template>
    <form @submit.prevent="create">

        <div class="form-group">
            <label for="password">Password <span class="text-danger">*</span></label>
            <input type="password" class="form-control" id="password" placeholder="password" v-model="form.password">
            <span class="text-danger" :class="{'hidden': errors['password'] == undefined}" style="margin-right:10px;">{{errors['password']}}</span>
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirm Password<span class="text-danger">*</span></label>
            <input type="password" class="form-control" id="password_confirmation" placeholder="password" v-model="form.password_confirmation">
            <span class="text-danger" :class="{'hidden': errors['password_confirmation'] == undefined}" style="margin-right:10px;">{{errors['password_confirmation']}}</span>
        </div>

        <span class="text-danger" :class="{'hidden': errors['general'] == undefined}" style="margin-right:10px;">{{errors['general']}}</span>

        <button type="submit" class="btn btn-primary" :disabled="disable.creating">Update Password</button>
    </form>
</template>

<script>
export default {
    props: {       
        afterCreatePath: {
            type: String,
            required: true
        }
    },

    data() {
        return {
            form: {                
                password        : '',
                password_confirmation: '',             
            },
            errors: [],
            disable: {
                creating: false
            }
        }
    },
    methods: {
        create() {
            this.disable.creating = true;
            var self = this;

            this.errors = [];
            axios.put('/api/users/password', this.form)
                .then(response => {
                    // Fixing the optimism.
                    this.disable.creating = false;
                    console.log("after creating");
                    window.location = this.afterCreatePath;
                })
                .catch(error => {
                    // Fixing the optimism.
                    this.disable.creating = false;
                   
                    _.forEach(error.response.data.errors, function(error, index) {
                        console.log(self.errors);
                        var errorIndex = _.startsWith(index, '_')
                                            ? _.trim(index, '_')
                                            : index;
                        
                        self.errors[errorIndex] = error[0];
                    });
                });
        },
    }
}
</script>

