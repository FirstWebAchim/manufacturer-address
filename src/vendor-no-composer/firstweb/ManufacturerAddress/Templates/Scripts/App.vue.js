const fwControllerFileName = 'fw_manufacturer_address.php';

var app = new Vue({
    el: '#app',

    data: {
        manufacturers: [],
        waitingForManufacturers: true,
        showSaveButton: false,
        saveButtonText: 'Änderung speichern',
        searchWord: '',
        pagination: new FwPagination(10),
    },

    mounted: function () {
        fetch(fwControllerFileName + '?action=getManufacturers')
        .then(response => response.json())
        .then(data => {
            this.waitingForManufacturers = false;

            console.log(data);

            // Fehlende Flags hinzufügen
            data.forEach(function(manufacturer) {
                manufacturer.flag = 'none';
            });

            this.manufacturers = data;
            this.showSaveButton = false;
        })
        .catch((error) => {
            this.waitingForManufacturers = false;
            console.error('Error:', error);
        });
    },
    
    methods: {
        save: function () {
            this.saveButtonText = 'bitte warten ...';

            seletedManufacturers = this.filterChangedManufacturers(this.manufacturers);

            // manufacturers an die Server API senden.
            fetch(fwControllerFileName + '?action=save', {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(seletedManufacturers)
            })
            .then(response => response.text())
            .then(data => {
                this.showSaveButton = false;
                this.saveButtonText = 'Änderung speichern';
            });
        },

        filterManufacturers: function(searchWord, manufacturers) {
            selectedManufacturers = manufacturers;
            selectedManufacturers = selectedManufacturers.filter(function(manufacturer) {
                if (searchWord) {
                    result = false;
                    result |= manufacturer.name.toLowerCase().includes(searchWord.toLowerCase());
                    if (manufacturer.fwManufacturerAddress.address) {
                        result |= manufacturer.fwManufacturerAddress.address.toLowerCase().includes(searchWord.toLowerCase());
                    }
                    return result;
                }
                return true;
            });
            return selectedManufacturers;
        },

        filterChangedManufacturers: function()
        {
            selectedManufacturers = [];
            this.manufacturers.forEach(function(manufacturer) {
                if (manufacturer.flag === 'none') {
                    return;
                }
                selectedManufacturers.push(manufacturer);
            });
            return selectedManufacturers;
        }
    },

    computed: {
        displayManufacturers: function() {
            seletectedManufacturers = this.manufacturers;
            seletectedManufacturers = this.filterManufacturers(this.searchWord, seletectedManufacturers);
            return this.pagination.paginate(seletectedManufacturers);
        }
    },

    template: `
        <div>
            <form v-on:submit.prevent="">
                <div class="input-group mb-3">
                    <input v-model="searchWord" type="text" class="form-control" placeholder="Filter Hersteller oder Adresse">
                    <button type="submit" class="btn btn-outline-primary" id="button-addon2">Filtern</button>
                </div>
            </form>

            <div v-if="displayManufacturers.length">
                <table class="table align-middle table-striped">
                    <thead>
                        <tr>
                            <th style="width: 1%" scope="col">ID</th>
                            <th style="width: 45%" scope="col">Hersteller</th>
                            <th style="width: 45%" scope="col">Adresse</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template v-for="manufacturer in displayManufacturers">
                            <tr v-if="manufacturer.flag != 'deleted'">
                                <td>
                                    {{ manufacturer.id }}
                                </td>
                                <td>
                                    {{ manufacturer.name }}
                                </td>
                                <td>
                                    <!-- {{ manufacturer.fwManufacturerAddress.address }} -->
                                    <manufacturer-address-edit-line
                                        :manufacturer-address="manufacturer.fwManufacturerAddress"
                                        v-on:change="manufacturer.flag = 'changed'; showSaveButton = true">
                                    </manufacturer-address-edit-line>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>

                <pagination-view
                    :pagination="pagination">
                </pagination-view>

            </div>
            <div v-else>
                <div class="alert alert-primary" role="alert">
                    Kein Hersteller vorhanden.
                </div>
            </div>

            <div v-if="waitingForManufacturers" class="text-center">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>

            <div v-if="showSaveButton" class="text-end">
                <button @click="save" type="button" class="btn btn-sm btn-success">
                    {{ saveButtonText }}
                </button>
            </div>

            <!-- <pre>
                {{ JSON.stringify(manufacturers, null, 2) }}
                {{ JSON.stringify(filterChangedManufacturers(), null, 2) }}
            </pre> -->
        </div>
    `
})