import {Book} from "../../types/books.t";
import {useState} from "react";
import ErrorThrower from "../../api/ErrorThrower";
import Api, {ApiResponse} from "../../api/Api";

type Response = {
    updateBook: (id: string, data: Partial<Book>) => Promise<ApiResponse<Book>>;
    updating: boolean;
}

const useUpdateBook = (): Response => {
    const [updating, setUpdating] = useState<boolean>(false);

    const updateBook = async (id: string, data: Partial<Book>): Promise<ApiResponse<Book>> => {
        setUpdating(true);

        const response = ErrorThrower(
            await Api<Book>(`books/v1/books/${id}`, {
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