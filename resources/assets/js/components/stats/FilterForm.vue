<template>
    <div>
        <date-picker v-model="dateRange" range lang="en"></date-picker>

        <a href @click.prevent="go">Go</a>
    </div>
</template>

<script>
export default {
    // props: ['filterPath', 'from', 'to'],

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
        }
    },

    data() {
        return {
            dateRange: [
                new Date(this.from),
                new Date(this.to)
            ]
        }
    },

    methods: {
        go() {
            window.location = this.makeFullFilterPath();
        },

        makeFullFilterPath() {
            let from = this.dateRange[0].toISOString().substring(0, 10);
            let to = this.dateRange[1].toISOString().substring(0, 10);

            return this.path + '?from=' + from + '&to=' + to
        }
    }
}
</script>

