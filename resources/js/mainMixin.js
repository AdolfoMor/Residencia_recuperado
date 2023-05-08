
const mainMixins = {
    data() {
        return{
            localErrors: []
        }
    },
    methods: {
        async filterData(e, callback){
            this.params = {
                ...e
            }
            await callback()
        },
        manageErrors(errors){
            this.localErrors = []
            if(typeof errors.response?.data === 'object'){
                this.localErrors = _.flatten(_.toArray(errors.response.data.errors));
            }else{
                this.localErrors = ['Algo salió mal :('];
            }
        }
    }
}

export default mainMixins