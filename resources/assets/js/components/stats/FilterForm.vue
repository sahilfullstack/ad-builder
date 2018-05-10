<template>
    <form>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <!-- <label for="date_range">Dates</label> -->
                    <date-picker v-model="form.dateRange" range lang="en" id="date_range"></date-picker>
                </div>
            </div>

            <div class="col-md-4" v-for="(filter, index) in filters" :key="index">
                <div class="form-group">
                    <!-- <label for="filter.slug">{{ filter.name }}</label> -->
                    <select :name="filter.slug" id="filter.slug" class="form-control" v-model="form.filters[filter.slug]">
                        <option :value="null">Select {{ filter.name }}</option>
                        <option v-for="(option_value, option_key) in filter.options" :key="option_key" :value="option_key">{{ option_value }}</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <a class="btn btn-primary" href @click.prevent="go">Go</a>
            </div>
        </div>

    </form>
</template>

<script>
export default {

    props: {
        path: {
            type: String,
            required: true,
        },
        from: {
            type: String,
            required: true,
        },
        to: {
            type: String,
            required: true,
        },
        filters: {
            type: Array,
            required: false,
        }
    },

    data() {
        return {
            form: {
                dateRange: [
                    new Date(this.from),
                    new Date(this.to)
                ],
                filters: {}
            }
        }
    },

    mounted() {
        let filters = {};
        _.forEach(this.filters, (filter) => {
            filters[filter.slug] = filter.selected;
        });
        Vue.set(this.form, 'filters', filters);
    },

    methods: {
        go() {
            window.location = this.makeFullFilterPath();
        },

        makeFullFilterPath() {
            let from = this.form.dateRange[0].toISOString().substring(0, 10);
            let to = this.form.dateRange[1].toISOString().substring(0, 10);

            let filterPath =  this.path + '?from=' + from + '&to=' + to;

            _.forEach(this.form.filters, (value, key) => {
                if(value != null) filterPath += '&' + key + '=' + value;
            });

            return filterPath;
        }
    }
}
</script>

