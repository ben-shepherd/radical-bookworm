import {useState} from "react";
import ErrorThrower from "../../api/ErrorThrower";
import Api, {ApiResponse} from "../../api/Api";

type Response = {
    success: boolean;
    type: boolean;
}
type Return = {
    updateFavouriteBook: (id: string) => Promise<ApiResponse<Response>>;
    updating: boolean;
}

const useUpdateFavouriteBook = (): Return => {
    const [updating, setUpdating] = useState<boolean>(false);

    const updateFavouriteBook = async (id: string): Promise<ApiResponse<Response>> => {
        setUpdating(true);

        const response = ErrorThrower(
            await Api<Response>(`/books/${id}/favourite`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                }
            })
        )

        setUpdating(false)

        return response
    }

    return {
        updating,
        updateFavouriteBook
    }
}

export default useUpdateFavouriteBook