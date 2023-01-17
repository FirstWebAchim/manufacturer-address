Vue.component('manufacturer-address-edit', {
    props: {
        'manufacturerAddress': {
            type: Object,
            default: []
        },
    },

    data: function () {
        return {
            localAddress: this.manufacturerAddress.address
        }
    },

    methods: {
        submit: function() {
            this.manufacturerAddress.address = this.localAddress;
            this.enabled = false;
            this.$emit('submit', this.manufacturerAddress);
        }
    },
    
    template: `
        <div style="position: relative">
            <div class="mb-3">
                <label for="manufacturer-address" class="form-label">Adresse</label>
                <textarea class="form-control" id="manufacturer-address" rows="3" v-model="localAddress"></textarea>
            </div>

            <button @click="submit" type="button" class="btn btn-sm btn-success float-end">
                Übernehmen
            </button>
        </div>
    `
});