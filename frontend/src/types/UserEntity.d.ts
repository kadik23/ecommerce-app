interface UserEntity {
    id?: number;
    username: string;
    email: string;
    password?: string;
    password_confirmation?: string;
    fullname?: string;
    address?: string;
    city?: string;
    country?: string;
    totalRevenue?: string;
    custumersNumber?: string;
    phone?: string;
    created_at?: date;
    updated_at?: date;
    profileImage?: string;
};