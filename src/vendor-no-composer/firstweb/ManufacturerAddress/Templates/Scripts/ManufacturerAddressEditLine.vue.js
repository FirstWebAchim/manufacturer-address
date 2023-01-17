Vue.component('manufacturer-address-edit-line', {
    props: {
        'manufacturerAddress': {
            type: Object,
            default: null
        },
    },

    data: function () {
        return {
            manufacturerAddressEditVisible: false
        }
    },

    methods: {
        select: function(manufacturerAddress) {
            this.manufacturerAddressEditVisible = false;
            this.$emit('change', manufacturerAddress);
        },

        close: function() {
            if (this.manufacturerAddressEditVisible == true) {
                this.manufacturerAddressEditVisible = false;
            }
        },

        display: function() {
            if (!this.manufacturerAddress || !this.manufacturerAddress.address) {
                return 'keine Herstelleraddresse vorhanen'
            }
            return this.manufacturerAddress.address;
        }
    },

    template: `
        <div style="position: relative">
            <div v-click-outside="close" class="fw-frame manufacturer-edit-frame" v-if="manufacturerAddressEditVisible">
                <manufacturer-address-edit
                    :manufacturer-address="manufacturerAddress"
                    v-on:submit="select($event)">
                </manufacturer-address-edit>
            </div>

            <span>{{ display() }}</span>

            <button class="btn btn-sm btn-outline-secondary" @click.stop="manufacturerAddressEditVisible = true">
                edit
            </button>
        </div>
    `
});