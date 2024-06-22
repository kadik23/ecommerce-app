interface UserEntity {
    [x: string]: any;
    id?: number;
    username: string;
    email: string;
    email_verified_at?: date;
    fullname?: string;
    profileImage?: string;
    city?: string;
    address?: string;
    country?: string;
    totalRevenue?: string;
    custumersNumber?: string;
    phone?: string;
    password?: string;
    password_confirmation?: string;
    created_at?: date;
    updated_at?: date;
};