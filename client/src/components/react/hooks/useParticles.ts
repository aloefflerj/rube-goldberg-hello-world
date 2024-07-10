import { get, post } from "../ApiRequest";

const routeBaseUrl = '/particles';

export const useParticles = () => ({
    fetchParticles: () => get(routeBaseUrl),
    fetchParticle: (id: string) => get(`${routeBaseUrl}/${id}`),
    createParticle: (body: any) => post(routeBaseUrl, body)
});
