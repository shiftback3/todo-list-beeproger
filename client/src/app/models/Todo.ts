export interface Todo {
    id: number;
    title: string;
    status: string;
    img_url: string;
    date?: Date;
    // date?: Date; make it optional 
}