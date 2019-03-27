<template>
    <form ref="form" v-on:submit="saveForm()">
        <div class="row">
            <div class="col-xs-12 form-group">
                <label class="control-label">Company name</label>
                <input type="text" v-model="organisation.company_name" class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 form-group">
                <label class="control-label">Email address</label>
                <input type="text" v-model="organisation.email_address" class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 form-group">
                <label class="control-label">Phone number</label>
                <input type="text" v-model="organisation.phone_number" class="form-control">
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
                organisationId: null,
                organisation: {
                    company_name: '',
                    email_address: '',
                    phone_number: '',
                }
            }
        },

        mounted() {
            if (this.$root.$refs.list.organisation) {
                this.editing = true;
                this.organisation = this.$root.$refs.list.organisation;
                this.organisationId = this.organisation.id;
            }
        },

        methods: {
            cancelForm() {
                event.preventDefault();
                this.$root.$refs.list.organisation = null;
                this.$parent.$emit('close');
            },

            saveForm() {
                event.preventDefault();
                this.editing ? this.saveEditedEntry() : this.saveNewEntry();
                this.$root.$refs.list.organisation = null;
                this.$parent.$emit('close');
            },

            saveEditedEntry() {
                axios.patch('/api/organisation/' + this.organisationId, this.organisation)
                    .catch(function (resp) {
                        if (resp == 200) {
                            alert("Company successfully updated");
                        } else {
                            console.log(resp);
                            alert("Could not update your company");
                        }
                    });
            },

            saveNewEntry() {
                var app = this;
                var newOrganisation = app.organisation;
                axios.post('/api/organisation', newOrganisation) 
                    .then((response) => {
                        this.$root.$refs.list.organisations.push(response.data);
                    })
                    .catch(function (resp) {
                        if (resp != 200) {
                            console.log(resp);
                            alert("Could not create your company");
                        }
                    });
            },
             
        }
    }
</script>