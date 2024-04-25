import { useMutation } from "react-query";
import pb from "lib/pocketbase";

export default function useLogout() {
    async function logout() {
        await pb.authStore.logout();
    }

    return useMutation(logout);
}
