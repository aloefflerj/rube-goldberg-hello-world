import axios, { type AxiosResponse } from 'axios';

const baseUrl = 'http://localhost:11000';

export function get(route: string, debug: boolean = false): Promise<AxiosResponse<any, any>> {
    return axios.get(`${baseUrl}${route}`, debug ? { headers: { debug: true } } : {});
}

export function post(route: string, body: any, debug: boolean = false): Promise<AxiosResponse<any, any>> {
    return axios.post(`${baseUrl}${route}`, body, debug ? { headers: { debug: true } } : {});
}