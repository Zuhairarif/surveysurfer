import useLogout from "hooks/useLogout";
import useLogin from "hooks/useLogin";
import pb from "lib/pocketbase";
import { useForm } from "react-hook-form";
import useVerified, {requestVerification} from "hooks/useVerified";

export default function Auth() {
    const logout = useLogout();
    const {data: isVerified, isRefetching} = useVerified();
    const { mutate: login, isLoading, isError } = useLogin();

    console.log(isRefetching);

    const { register, handleSubmit, reset } = useForm();
    const isLoggedIn = pb.authStore.isValid;
    async function onSubmit(data)  {
        login({ email: data.email, password: data.password});
        reset();
    }
    if(isLoggedIn)
    return (
<>
<h1>Logged In: {pb.authStore.model.email}</h1>
<p>Verified: {isVerified?.toString()}</p>
{!isVerified && <button onClick={requestVerification}>Send Verification Email</button>}
<button> onClick={logout}>Log Out</button>
</>
};
return (
    <>
    {isLoading && <p>Loading...</p>}
    {isError && <p style={{ color: "red" }}>Invalid email or password</p>}
    
    </>
)