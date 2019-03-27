<template>
    <form ref="form" v-on:submit="saveForm()">
        <div class="row">
            <div class="col-xs-12 form-group">
                <label class="control-label">Sector name</label>
                <input type="text" v-model="sector.sector_name" class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 form-group">
                <label class="control-label">Industry</label>
                <select v-model="sector.industry_name" v-on:change="setIndustry($event)" class="form-control">
                    <option value='0' >Select Industry</option>
                    <option v-for='data in industries' :id='data.id' :value='data.industry_name' :key='data.id'>{{ data.industry_name }}</option>
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
                sectorId: null,
                sector: {
                    sector_name: '',
                    industry_id: '',
                    industry_name: '',
                },
                industries: []
            }
        },

        mounted() {
            var app = this;
            axios.get('/api/industry')
                .then(function (resp) {
                    app.industries = resp.data;
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load industries");
                });
            if (this.$root.$refs.list.sector) {
                this.editing = true;
                this.sector = this.$root.$refs.list.sector;
                this.sectorId = this.sector.id;
            }
        },

        methods: {

            setIndustry(event) {
                this.sector.industry_id = event.target.options[event.target.selectedIndex].attributes[0].value;
                this.sector.industry_name = event.target.value;
            },

            cancelForm() {
                event.preventDefault();
                this.$root.$refs.list.sector = null;
                this.$parent.$emit('close');
            },

            saveForm() {
                event.preventDefault();
                this.editing ? this.saveEditedEntry() : this.saveNewEntry();
                this.$root.$refs.list.sector = null;
                this.$parent.$emit('close');
            },

            saveEditedEntry() {
                var app = this;
                axios.patch('/api/sector/' + app.sectorId, app.sector)
                    .catch(function (resp) {
                        if (resp == 200) {
                            alert("Sector successfully updated");
                        } else {
                            console.log(resp);
                            alert("Could not update sector record");
                        }
                    });
            },

            saveNewEntry() {
                var app = this;
                var newEntry = app.sector;
                axios.post('/api/sector', newEntry) 
                    .then((response) => {
                        this.$root.$refs.list.sectors.push(response.data);
                    })
                    .catch(function (resp) {
                        if (resp != 200) {
                            console.log(resp);
                            alert("Could not create sector record");
                        }
                    });
            },
             
        }
    }
</script>