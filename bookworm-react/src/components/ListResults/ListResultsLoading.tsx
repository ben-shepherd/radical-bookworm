import {Book} from 'types/books.t';
import ListItemLoading from "./ListItemLoading";

const ListResultsLoading = ({maxItems = 2}: { maxItems?: number }) => {
    return (
        <div className="ListResults">
            {[...Array(maxItems)].map((book: Book) => (
                <ListItemLoading className={'mb-5'}/>
            ))}
        </div>
    )
}

export default ListResultsLoading;