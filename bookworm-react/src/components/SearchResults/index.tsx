import ListResults from 'components/ListResults';
import React from 'react';
import {Book} from 'types/books.t';

type Props = {
    results: Book[];
    PreSearchComponent?: () => React.ReactNode | null,
    PostSearchComponent: (searchResultsComponent: React.ReactNode) => React.ReactNode;
    onClick?: (book: Book) => any;
    onRefresh?: (...args: any[]) => any;
}

const SearchResults = ({
                           results,
                           PreSearchComponent,
                           PostSearchComponent,
                           onClick,
                           onRefresh
                       }: Props): React.ReactNode => {

    if (PreSearchComponent && results.length === 0) {
        return PreSearchComponent()
    }

    return PostSearchComponent(
        <ListResults results={results} onClick={onClick} onRefresh={onRefresh}/>
    )
}

export default SearchResults