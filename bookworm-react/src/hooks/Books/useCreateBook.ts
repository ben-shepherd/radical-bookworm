import { useState } from "react";
import Api, { ApiResponse } from "../../api/Api";
import ErrorThrower from "../../api/ErrorThrower";
import { Book } from "../../types/books.t";

type Response = {
    createBook: (data: Book) => Promise<ApiResponse<Book>>;
    creating: boolean;
}

const useCreateBook = (): Response => {
    const [creating, setCreating] = useState<boolean>(false);

    const createBook = async (data: Partial<Book>): Promise<ApiResponse<Book>> => {
        setCreating(true);

        const response = ErrorThrower(
            await Api<Book>(`/books`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
        )

        setCreating(false)

        return response
    }

    return {
        creating,
        createBook
    }
}

export default useCreateBook