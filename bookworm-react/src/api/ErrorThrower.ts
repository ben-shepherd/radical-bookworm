import { enqueueSnackbar } from "notistack"
import { ApiResponse } from "./Api"

const ErrorThrower = <Response>(response: ApiResponse<Response>): ApiResponse<Response> => {
    if (!response.ok) {
        console.error(response)
        enqueueSnackbar({ message: response.json.message, variant: 'error' })
    }

    return response
}

export default ErrorThrower