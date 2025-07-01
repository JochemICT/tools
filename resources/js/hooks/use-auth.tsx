import { usePage } from '@inertiajs/react';
import { User } from '@/types';

interface AuthProps {
    user: {
        id: number;
        name: string;
        email: string;
        email_verified_at: string | null;
        created_at: string;
        updated_at: string;
        is_admin: boolean
    } | null;
}

interface PageProps extends Record<string, unknown> {
    auth: AuthProps;
}

export function useAuth() {
    const { auth } = usePage<PageProps>().props;
    return auth;
}

export function useUser(): User | null {
    const { auth } = usePage<PageProps>().props;
    return auth?.user ?? null;
}
