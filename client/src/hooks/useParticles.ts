import { get, post } from "../ApiRequest";

const routeBaseUrl = '/particles';

export const useParticles = () => ({
    fetchParticles: (debug: boolean = false) => get(routeBaseUrl, debug),
    fetchParticle: (id: string, debug: boolean = false) => get(`${routeBaseUrl}/${id}`, debug),
    createParticle: (body: any, debug: boolean = false) => post(routeBaseUrl, body, debug)
});
