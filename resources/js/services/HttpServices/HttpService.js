import axios from "axios";
class HttpService {
    static get(url,params){
        if (!params){
            return axios.get(url);
        }
        return axios.get(url,params);
    }
    static post(url,params){
        return axios.post(url,params);
    }
}
export default HttpService;
