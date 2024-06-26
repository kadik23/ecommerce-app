interface OrderEntity {
    id: string;
    dateOrder: Date;
    quantity: number;
    paymentMethod?: 'string';
    deliveryMethod?: 'string';
    orderBy: string;
    Product: string;
    deleted_at?: Date;
}