type Route = {
    path: string,
    name?: string,
    redirect?: string,
    component: Component,
    children?: Route[]
}