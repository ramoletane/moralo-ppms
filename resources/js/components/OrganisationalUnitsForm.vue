<template>
    <form ref="form" v-on:submit="saveForm()">
        <div class="row">
            <div class="col-xs-12 form-group">
                <label class="control-label">Unit name</label>
                <input type="text" v-model="organisational_unit.unit_name" class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 form-group">
                <label class="control-label">Belongs to</label>
                <input type="text" v-model="organisational_unit.parent_unit_id" class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 form-group">
                <label class="control-label">Company</label>
                <select v-model="organisational_unit.company_name" v-on:change="setCompanyId($event)" class="form-control">
                    <option value='0' >Select Company</option>
                    <option v-for='data in organisations' :id='data.id' :value='data.company_name' :key='data.id'>{{ data.company_name }}</option>
                </select>
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
                organisational_unitId: null,
                organisational_unit: {
                    unit_name: '',
                    parent_unit_id: '',
                    company_id: '',
                    company_name: '',
                },
                organisations: []
            }
        },

        mounted() {
            var app = this;
            axios.get('/api/organisation')
                .then(function (resp) {
                    app.organisations = resp.data;
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load organisations");
                });
            if (this.$root.$refs.list.organisational_unit) {
                this.editing = true;
                this.organisational_unit = this.$root.$refs.list.organisational_unit;
                this.organisational_unitId = this.organisational_unit.id;
            }
        },

        methods: {

            setCompanyId(event) {
                this.organisational_unit.company_id = event.target.options[event.target.selectedIndex].attributes[0].value;
                this.organisational_unit.company_name = event.target.value;
            },

            cancelForm() {
                event.preventDefault();
                this.$root.$refs.list.organisational_unit = null;
                this.$parent.$emit('close');
            },

            saveForm() {
                event.preventDefault();
                this.editing ? this.saveEditedEntry() : this.saveNewEntry();
                this.$root.$refs.list.organisational_unit = null;
                this.$parent.$emit('close');
            },

            saveEditedEntry() {
                var app = this;
                axios.patch('/api/organisational-unit/' + app.organisational_unitId, app.organisational_unit)
                    .catch(function (resp) {
                        if (resp == 200) {
                            alert("Company successfully updated");
                        } else {
                            console.log(resp);
                            alert("Could not update your unit");
                        }
                    });
            },

            saveNewEntry() {
                var app = this;
                var newEntry = app.organisational_unit;
                axios.post('/api/organisational-unit', newEntry) 
                    .then((response) => {
                        this.$root.$refs.list.organisational_units.push(response.data);
                    })
                    .catch(function (resp) {
                        if (resp != 200) {
                            console.log(resp);
                            alert("Could not create your unit");
                        }
                    });
            },
             
        }
    }
</script>