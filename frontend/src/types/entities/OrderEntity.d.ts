interface OrderEntity {
    id?: string;
    dateOrder?: Date;
    quantity: number;
    paymentMethod?: string;
    deliveryMethod?: string;
    orderBy: number;
    Product: string;
    deleted_at?: Date;
    created_at: Date;
    updated_at: Date;
    state: 'confirm' | 'complete' | 'canceled' | 'pending' 
}