<template>
    <form @submit.prevent="create">

        <div class="form-group">
            <label for="name">Full Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="name" placeholder="John Doe" v-model="form.name">
            <span class="text-danger" :class="{'hidden': errors['name'] == undefined}" style="margin-right:10px;">{{errors['name']}}</span>
        </div>

        <div class="form-group">
            <label for="company">Company <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="company" placeholder="Specal 26" v-model="form.company">
            <span class="text-danger" :class="{'hidden': errors['company'] == undefined}" style="margin-right:10px;">{{errors['company']}}</span>
        </div>

        <div class="form-group">
            <label for="phone">Phone<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="phone" placeholder="9999999999" v-model="form.phone">
            <span class="text-danger" :class="{'hidden': errors['phone'] == undefined}" style="margin-right:10px;">{{errors['phone']}}</span>
        </div>

        <div class="form-group">
            <label for="email">Email <span class="text-danger">*</span></label>
            <input type="email" class="form-control" id="email" placeholder="something@something.com" v-model="form.email">
            <span class="text-danger" :class="{'hidden': errors['email'] == undefined}" style="margin-right:10px;">{{errors['email']}}</span>
        </div>

        <div class="form-group">
            <label for="username">Username <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="username" placeholder="username" v-model="form.username">
            <span class="text-danger" :class="{'hidden': errors['username'] == undefined}" style="margin-right:10px;">{{errors['username']}}</span>
        </div>

        <div class="form-group">
            <label for="role">Role <span class="text-danger">*</span></label>
            <select name="role" id="role" class="form-control" v-model="form.role">
                <option value="admin">Admin</option>
                <option value="advertiser">Advertiser</option>
            </select>
        </div>

        <span class="text-danger" :class="{'hidden': errors['general'] == undefined}" style="margin-right:10px;">{{errors['general']}}</span>

        <button type="submit" class="btn btn-primary" :disabled="disable.creating">Create</button>
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
                name    : '',
                company : '',
                phone   : '',
                email   : '',
                username: '',
                role    : 'advertiser',
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

            axios.post('/api/users/create', this.form)
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

