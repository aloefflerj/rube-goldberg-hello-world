import axios, { type AxiosResponse } from 'axios';

const baseUrl = 'http://localhost:11000';
const serverBaseUrl = 'http://api:80'

export function get(route: string, debug: boolean = false, callFromServer: boolean = false): Promise<AxiosResponse<any, any>> {
    return axios.get(`${callFromServer ? serverBaseUrl : baseUrl}${route}`, debug ? { headers: { debug: true } } : {});
}

export function post(route: string, body: any = {}, debug: boolean = false, callFromServer: boolean = false): Promise<AxiosResponse<any, any>> {
    return axios.post(`${callFromServer ? serverBaseUrl : baseUrl}${route}`, body, debug ? { headers: { debug: true } } : {});
}

export function put(route: string, body: any = {}, debug: boolean = false, callFromServer: boolean = false): Promise<AxiosResponse<any, any>> {
    return axios.put(`${callFromServer ? serverBaseUrl : baseUrl}${route}`, body, debug ? { headers: { debug: true } } : {});
}