import { ref } from 'vue'
import axios from 'axios'

export default function useAfiliado(){
    const afiliado = ref ([])
    const getAfiliado = async () => {
        const response = axios.get('')
    }
}