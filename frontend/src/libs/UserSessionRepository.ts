interface LocalStorage {
    getItem(key: string): string | null;
    setItem(key: string, value: string): void;
    removeItem(key: string): void;
}

const ACCESS_TOKEN_KEY = "access_token";
const ACCOUNT_TYPE_KEY = "account_type";

export default class UserSessionRepository {
    localStorage: LocalStorage;

    constructor(localStorage: LocalStorage) {
        this.localStorage = localStorage;
    }

    save(userSession: UserSession): void {
        const { access_token, account_type } = userSession;
        this.localStorage.setItem(ACCESS_TOKEN_KEY, access_token);
        this.localStorage.setItem(ACCOUNT_TYPE_KEY, account_type);
    }

    getAccessToken(): string | null {
        return this.localStorage.getItem(ACCESS_TOKEN_KEY);
    }

    getAccountType(): string | null {
        return this.localStorage.getItem(ACCOUNT_TYPE_KEY);
    }

    clear(): void {
        this.localStorage.removeItem(ACCESS_TOKEN_KEY);
        this.localStorage.removeItem(ACCOUNT_TYPE_KEY);
    }
}
