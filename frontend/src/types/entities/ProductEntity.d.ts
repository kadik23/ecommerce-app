interface ProductEntity{
    id: string;
    name: string;
    price: number;
    description?: string;
    profileImage: string;
    category: Category;
    rating?: number;
    quantity?: number;
    sold?: number;
    createdBy?: string;
    deletedBy?: number;
    updatedBy?: number;
    created_at: data;
    updated_at: data;
}

enum Category {"Electronics" , "Phones" , "Accessories"}
