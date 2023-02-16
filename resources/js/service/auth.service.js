import BaseService from "./base.service"
import { TOKEN_NAME } from '@/configs'

export default class AuthService extends BaseService {

    static async auth (params) {
        return new Promise((resolve, reject) => {

            this.request()
                .post('/auth', params)
                .then(response => {
                    localStorage.setItem(TOKEN_NAME, response.data.token)
                    resolve(response)
                })
                .catch(error => reject(error.response))
        })
    }


    static async forgetPassword (params) {
        return new Promise((resolve, reject) => {
            this.request()
                .post('/forget-password', params)
                .then(response => resolve(response))
                .catch(error => reject(error.response))
        })
    }
    
    static async userSave (params) {
        return new Promise((resolve, reject) => {
            this.request()
                .post('/registerUser', params)
                .then(response => resolve(response.data))
                .catch(error => reject(error.response))
        })
    }

}