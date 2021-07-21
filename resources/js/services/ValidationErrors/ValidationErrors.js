class ValidationErrors {
    constructor() {
        this.errors={}
    }
    store(errors){
        this.errors=errors;
    }
    has(item){
        return this.errors.hasOwnProperty(item);
    }
    errorTitle(item){
        if (this.errors[item]){
            return this.errors[item][0];
        }
    }
}
export default ValidationErrors;
