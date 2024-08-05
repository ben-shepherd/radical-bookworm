import { useState } from "react";
import Api, { ApiResponse } from "../../api/Api";
import ErrorThrower from "../../api/ErrorThrower";

type Response = {
    success: boolean;
    type: boolean;
}
type Return = {
    updateFavouriteBook: (id: number) => Promise<ApiResponse<Response>>;
    updating: boolean;
}

const useUpdateFavouriteBook = (): Return => {
    const [updating, setUpdating] = useState<boolean>(false);

    const updateFavouriteBook = async (id: number): Promise<ApiResponse<Response>> => {
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