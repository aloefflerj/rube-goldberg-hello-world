import { get, post } from "../ApiRequest";

const routeBaseUrl = '/particles';

export const useParticles = (callFromServer = false) => ({
    fetchParticles: (debug: boolean = false) => get(routeBaseUrl, debug, callFromServer),
    fetchParticle: (id: string, debug: boolean = false) => get(`${routeBaseUrl}/${id}`, debug, callFromServer),
    createParticle: (body: any, debug: boolean = false) => post(routeBaseUrl, body, debug, callFromServer)
});
