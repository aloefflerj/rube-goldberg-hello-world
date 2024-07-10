import axios, { type AxiosResponse } from 'axios';

const baseUrl = 'http://localhost:11000';

export function get(route: string): Promise<AxiosResponse<any, any>> {
    return axios.get(`${baseUrl}${route}`);
}

export function post(route: string, body: any): Promise<AxiosResponse<any, any>> {
    return axios.post(`${baseUrl}${route}`, body);
}