export default interface Step {
    id: string;
    title: string,
    order: number;
    status: 'waiting' | 'ongoing' | 'finished';
}