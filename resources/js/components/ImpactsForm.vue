<template>
    <form ref="form" v-on:submit="saveForm()">
        <div class="row">
            <div class="col-xs-12 form-group">
                <label class="control-label">Impact name</label>
                <input type="text" v-model="impact.impact_name" class="form-control">
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
                impactId: null,
                impact: {
                    impact_name: '',
                }
            }
        },

        mounted() {
            if (this.$root.$refs.list.impact) {
                this.editing = true;
                this.impact = this.$root.$refs.list.impact;
                this.impactId = this.impact.id;
            }
        },

        methods: {
            cancelForm() {
                event.preventDefault();
                this.$root.$refs.list.impact = null;
                this.$parent.$emit('close');
            },

            saveForm() {
                event.preventDefault();
                this.editing ? this.saveEditedEntry() : this.saveNewEntry();
                this.$root.$refs.list.impact = null;
                this.$parent.$emit('close');
            },

            saveEditedEntry() {
                axios.patch('/api/impact/' + this.impactId, this.impact)
                    .catch(function (resp) {
                        if (resp == 200) {
                            alert("Impact successfully updated");
                        } else {
                            console.log(resp);
                            alert("Could not update impact record");
                        }
                    });
            },

            saveNewEntry() {
                axios.post('/api/impact', this.impact) 
                    .then((response) => {
                        this.$root.$refs.list.impacts.push(response.data);
                    })
                    .catch(function (response) {
                        if (response.status != 200) {
                            console.log(response);
                            alert("Could not create impact record");
                        }
                    });
            },
             
        }
    }
</script>