<template>
    <form ref="form" v-on:submit="saveForm()">
        <div class="row">
            <div class="col-xs-12 form-group">
                <label class="control-label">Industry name</label>
                <input type="text" v-model="industry.industry_name" class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 form-group">
                <button class="btn btn-success">Submit</button>
                <button class="btn btn-default" @click="cancelForm()">Cancel</button>
            </div>
        </div>
    </form>
</template>

<script>
    export default {

        data: function () {
            return {
                industryId: null,
                industry: {
                    industry_name: '',
                }
            }
        },

        mounted() {
            if (this.$root.$refs.list.industry) {
                this.editing = true;
                this.industry = this.$root.$refs.list.industry;
                this.industryId = this.industry.id;
            }
        },

        methods: {
            cancelForm() {
                event.preventDefault();
                this.$root.$refs.list.industry = null;
                this.$parent.$emit('close');
            },

            saveForm() {
                event.preventDefault();
                this.editing ? this.saveEditedEntry() : this.saveNewEntry();
                this.$root.$refs.list.industry = null;
                this.$parent.$emit('close');
            },

            saveEditedEntry() {
                axios.patch('/api/industry/' + this.industryId, this.industry)
                    .catch(function (resp) {
                        if (resp == 200) {
                            alert("Company successfully updated");
                        } else {
                            console.log(resp);
                            alert("Could not update industry record");
                        }
                    });
            },

            saveNewEntry() {
                var app = this;
                var newEntry = app.industry;
                axios.post('/api/industry', newEntry) 
                    .then((response) => {
                        this.$root.$refs.list.industries.push(response.data);
                    })
                    .catch(function (resp) {
                        if (resp != 200) {
                            console.log(resp);
                            alert("Could not create industry record");
                        }
                    });
            },
             
        }
    }
</script>