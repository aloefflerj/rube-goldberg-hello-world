export default interface AppLog {
    messageType: string;
    className: string;
    functionName: string;
    abstractionLayer: string;
    abstractionType: 'webFramework' |
        'webAdapter' |
        'mysqlDriver' |
        'mysqlAdapter' |
        'useCase' |
        'domain' |
        'unkown' |
        '';
}