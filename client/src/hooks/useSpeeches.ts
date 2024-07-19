import type { AxiosResponse } from 'axios';
import { get } from '../ApiRequest';
import type Speech from '../types/Speech';

const routeBaseUrl = '/speeches';

export const useSpeeches = (callFromServer = false) => ({
    fetchSpeeches: (
        debug: boolean = false
    ): Promise<AxiosResponse<{ speeches: Speech[] }, any>> => get(
        routeBaseUrl,
        debug,
        callFromServer
    ),
});