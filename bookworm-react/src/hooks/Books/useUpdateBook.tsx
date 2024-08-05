import { useState } from "react";
import Api, { ApiResponse } from "../../api/Api";
import ErrorThrower from "../../api/ErrorThrower";
import { Book } from "../../types/books.t";

type Response = {
    updateBook: (id: number, data: Partial<Book>) => Promise<ApiResponse<Book>>;
    updating: boolean;
}

const useUpdateBook = (): Response => {
    const [updating, setUpdating] = useState<boolean>(false);

    const updateBook = async (id: number, data: Partial<Book>): Promise<ApiResponse<Book>> => {
        setUpdating(true);

        const response = ErrorThrower(
            await Api<Book>(`/books/${id}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
        )

        setUpdating(false)

        return response
    }

    return {
        updating,
        updateBook
    }
}

export default useUpdateBook